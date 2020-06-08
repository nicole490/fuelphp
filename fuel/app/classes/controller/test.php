class Controller_Test extends Controller
{
    public function get_index()
    {
        $data = array();
        $data[‘name’] = ‘（任意の名前）’;
        $data[‘title’] = ‘Welcome’;
        return View::forge(‘test/hello’, $data);
    }
    public function post_index()
    {
        // HTTPのPOSTメソッド時の動作
    }
}