<?php
namespace Reverence\Controller;
use Reverence\Config\Config;
/**
 * Description of AbstractAjaxHandler
 *
 * @author bnelson
 */
class AbstractJson extends AbstractBase {
    protected $_response = array();
    protected $_errors = array();
    protected $_ok = true;

    protected function assign($name, $value) {
        $this->_response[$name] = $value;
    }

    public function display() {
        if (!array_key_exists('as_text', $_GET)) {
            \Reverence\HTTP\Response::contentType('application/json');
        }
        else
        {
           \Reverence\HTTP\Response::contentType('text/plain');
        }

        if ($this->_ok !== true) {
            $resp = json_encode(
                array('errors'=>$this->_errors)
            );
        }
        else {
            $resp = json_encode(
                $this->_response
            );
        }
        if (Config::get('debug')) {
            echo \Reverence\Utils\Json::json_format($resp);
        }
        else {
            echo $resp;
        }
    }
}

?>
