<?php

class EloquentController extends BaseController
{
    //protected $layout = 'layouts.eloquent';
    protected $runner;

    public function __construct()
    {
        parent::__construct();

        $this->runner = new EloquentRunner();

        $that = $this; //to avoid 'Cannot use $this as lexical variable' error
        try {
            DB::listen(function ($sql, $bindings, $time, $connectionName) use ($that) {
                $sql = str_replace(['%', '?'], ['%%', '\'%s\''], $sql);
                $sql = vsprintf($sql, $bindings);
                $that->runner->addSql($sql);
            });
        } catch (\Exception $e) {
            //('Cannot add listen to Queries for Laravel Debugbar: '. $e->getMessage(), $e->getCode(), $e));
        }
    }

    public function getIndex()
    {
        $runner = $this->runner;

        $this->view('eloquent.index', compact('runner'));
    }

    public function postExec()
    {
        if (! Request::ajax()) {
            App::abort(404);
        }

        $code = Input::get('code');

        $runner = $this->runner;
        $runner->evalCode($code);

        $results = $runner->getResult();

        return Response::json($results, 200);
    }
}
