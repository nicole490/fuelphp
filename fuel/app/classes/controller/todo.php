<?php

/**
 * The Todo Controller.
 *
 * @package  app
 * @extends  Controller
 */
// Class 名の先頭には必ず Controller_ を付与すること
class Controller_Todo extends Controller_Rest
{
    protected $format = 'json';

    /**
     * @access  public
     * @return  Response
     */
    /*
     * 利用者からアクセスのある function 名の先頭には
     * 必ず action_ を付与すること
     * 
     * scope は public であること
     */
    public function action_index()
    {
        return Response::forge(View::forge('index'));
    }

    /*
     * 利用者からアクセスのある function 名の先頭には
     * 必ず action_ を付与すること
     * 
     * scope は public であること
     */
    public function get_list()
    {
        // todos テーブルに格納した 3 つのテストデータを取得
        $todos = Model_Todo::find('all');
        return $this->response($todos);
    }

    public function post_create()
    {
        $todo = Model_Todo::forge();
        $todo->note = \Input::json('note');
        $todo->created = Date::forge()->format("%Y-%m-%d %H:%M:%S");
        $todo->updated = Date::forge()->format("%Y-%m-%d %H:%M:%S");
        $val = Validation::instance();
        // noteカラムにバリデートを設定
        $val->add_field('note', 'ノート', 'required|max_length[20]');

        if ($val->run(\Input::json())) {
            // バリデーション成功
            $todo->save();
            return $this->response($todo);
        } else {
            $errors = $val->error();
            foreach ($errors as $field => $error) {
                $json['errors'][$field] = $error->get_message();
            }
            // バリデーション失敗の場合、エラーメッセージを400と共に返却
            return $this->response($json, 400);
        }
    }

    /**
     * @access  public
     * @return  Response
     */
    public function get_detail()
    {
        $todo = Model_Todo::find($this->param('id'));
        return $this->response($todo);
    }

    /**
     * @access  public
     * @return  Response
     */
    public function post_update()
    {
        $todo = Model_Todo::find($this->param('id'));
        $todo->note = \Input::json('note');
        $todo->updated = Date::forge()->format("%Y-%m-%d %H:%M:%S");
        $val = Validation::instance();
        // noteカラムにバリデートを設定
        $val->add_field('note', 'ノート', 'required|max_length[20]');

        if ($val->run(\Input::json())) {
            // バリデーション成功
            $todo->save();
            return $this->response($todo);
        } else {
            $errors = $val->error();
            foreach ($errors as $field => $error) {
                $json['errors'][$field] = $error->get_message();
            }
            // バリデーション失敗の場合、エラーメッセージを400と共に返却
            return $this->response($json, 400);
        }
    }

    /**
     * @access  public
     * @return  Response
     */
    public function delete_item()
    {
        $todo = Model_Todo::find($this->param('id'));
        $todo->delete();
        $todos = Model_Todo::find('all');

        return $this->response($todos);
    }
}
