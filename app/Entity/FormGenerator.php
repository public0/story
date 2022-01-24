<?php


namespace App\Entity;


trait FormGenerator
{
    public function generate() :string {
        try {
            $className = explode('\\', get_class($this));
            $className = end($className);
            $class = get_class($this);
            $class = new \ReflectionClass($class);
            $methods = $class->getMethods(\ReflectionMethod::IS_FINAL);
            $form = "<table>
                <tbody>
                <thead>
                <th><h3>$className</h3></th>
                </thead>\n";
            foreach ($this as $prop=>$value) {
                $form .= "<tr><td>
                    <label for='$prop'>$prop</label></td><td><input type='text' name='".$className."[$prop]' id='$prop' value='$value' />
                    </td></tr>\n";
            }
            $form .= "<tr><td></td><td><input type='submit' value='Save'/></td></tr>\n";
            $form .= '</tbody></table>';
            return $form;
        } catch (\ReflectionException $e) {
            echo $e->getMessage();
        }
    }


}