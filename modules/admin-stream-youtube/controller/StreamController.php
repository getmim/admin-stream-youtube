<?php
/**
 * StreamController
 * @package admin-stream-youtube
 * @version 0.0.1
 */

namespace AdminStreamYoutube\Controller;

use LibFormatter\Library\Formatter;
use LibForm\Library\Form;
use LibForm\Library\Combiner;
use StreamYoutube\Model\StreamYoutube as SYoutube;

class StreamController extends \Admin\Controller
{
    private function getParams(string $title): array{
        return [
            '_meta' => [
                'title' => $title,
                'menus' => ['stream','youtube']
            ],
            'subtitle' => $title,
            'pages' => null
        ];
    }

    public function editAction(){
        if(!$this->user->isLogin())
            return $this->loginFirst(1);
        if(!$this->can_i->manage_stream_youtube)
            return $this->show404();

        $youtube = SYoutube::getOne([]);
        if(!$youtube)
            return $this->show404();

        $id = $youtube->id;

        $params = $this->getParams('Edit Youtube Stream');

        $form           = new Form('admin.stream-youtube.edit');
        $params['form'] = $form;
        $params['saved'] = false;

        $c_opts = [
            'meta'       => [null,                  null, 'json']
        ];

        $combiner = new Combiner($id, $c_opts, 'stream-youtube');
        $youtube  = $combiner->prepare($youtube);

        if(!($valid = $form->validate($youtube)) || !$form->csrfTest('noob'))
            return $this->resp('stream/youtube/edit', $params);

        $valid = $combiner->finalize($valid);

        if(!SYoutube::set((array)$valid, ['id'=>$id]))
            deb(SYoutube::lastError());

        // add the log
        $this->addLog([
            'user'   => $this->user->id,
            'object' => $id,
            'parent' => 0,
            'method' => 2,
            'type'   => 'stream-youtube',
            'original' => $youtube,
            'changes'  => $valid
        ]);

        $params['saved'] = true;

        return $this->resp('stream/youtube/edit', $params);
    }
}