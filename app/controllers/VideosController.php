<?php

class VideosController extends BaseController
{

    /**
     * Display a listing of the resource.
     * GET /videos
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /videos/create
     *
     * @return Response
     */
    public function create()
    {
        $this->view('videos.form');
    }

    /**
     * Store a newly created resource in storage.
     * POST /videos
     *
     * @return Response
     */
    public function store()
    {
        // FIXME: form validation

        $file = Input::file('file');
        $destinationPath = 'uploads';
        // If the uploads fail due to file system, you can try doing
        // public_path().'/uploads'
        $basename = str_random(12);
        $filename = $basename . '.' . $file->getClientOriginalExtension();
        // $filename = $file->getClientOriginalName();
        // $extension =$file->getClientOriginalExtension();
        $upload_success = Input::file('file')->move($destinationPath, $filename);

        $videoFile = $destinationPath . '/' . $filename;

        $ffmpeg = FFMpeg\FFMpeg::create([
            'ffmpeg.binaries'  => '/home/vagrant/bin/ffmpeg',
            'ffprobe.binaries' => '/home/vagrant/bin/ffprobe',
            'timeout'          => 3600, // The timeout for the underlying process
            'ffmpeg.threads'   => 12 // The number of threads that FFMpeg should use
        ]);
        $video = $ffmpeg->open($videoFile);

        $ffprobe = $ffmpeg->getFFProbe();
        $duration = $ffprobe->format($videoFile)->get('duration');
        $interval  = (int) ($duration / 5);
        for ($i = 0, $time = 0; $i < 6; $i++, $time += $interval) {
            $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($time))
                ->save($destinationPath . '/' . $basename . $i . '.jpg');
        }

        if ($upload_success) {
            $result = [
                'video' => '/uploads/' . $filename,
                'thumbnail' => [
                    '/uploads/' . $basename . '0.jpg',
                    '/uploads/' . $basename . '1.jpg',
                    '/uploads/' . $basename . '2.jpg',
                    '/uploads/' . $basename . '3.jpg',
                    '/uploads/' . $basename . '4.jpg',
                    '/uploads/' . $basename . '5.jpg',
                ]
            ];
            return Response::json($result, 200);
        } else {
            return Response::json('error', 400);
        }
    }

    /**
     * Display the specified resource.
     * GET /videos/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /videos/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /videos/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /videos/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
