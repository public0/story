<?php
namespace App\Utility;

class Http {
    public static function response($content, $code) {
        http_response_code($code);
        ob_start();
        $fp = fopen("php://output", 'r+');
        $template = <<<EOD
<!DOCTYPE html>
<html>
<body>
{$content}
</body>
</html>
EOD;
;
        fputs($fp, $template);
        ob_end_flush();
    }

    public static function formResponse(array $data, $code) {
        http_response_code($code);
        ob_start();
        $fp = fopen("php://output", 'r+');
        $content = '';
        foreach ($data as $form) {
            $content .= $form;
        }

        $template = <<<EOD
<!DOCTYPE html>
<html>
<body style="background-color: darkgray">
<form action="" method="post" style="">
<div style="">
{$content}
</div>
<input type="submit" value="Fight" 
  style="margin: 0 auto;
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: block;
  font-size: 16px;"/>
</form>
</body>
</html>
EOD;
        fputs($fp, $template);
        ob_end_flush();
    }


    public static function request() {
        return $_REQUEST;
    }
}