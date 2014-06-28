<?php

class FormerController extends BaseController {

    public function getIndex()
    {
        $this->view('former.index');
    }

    public function getValidate()
    {
        $this->view('former.validate');
    }

    public function postValidate()
    {
        $rules = array(
            'name' => 'required|min:10',
            'email' => 'required|email',
            'comments' => 'required|min:10'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            echo "success";
        }
    }
}
