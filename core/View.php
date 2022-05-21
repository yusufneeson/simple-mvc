<?php

namespace Core;

class View
{
    public function load($view, $options)
    {
        $view_path = __DIR__ . '/../app/views/';
        $view = $view_path . $view;

        $ext = pathinfo($view, PATHINFO_EXTENSION);
        $view = empty($ext) ? $view . '.php' : $view;

        extract($options);

        ob_start();

        if (!is_php('5.4') && !ini_get('short_open_tag')) {
            echo eval('?>' . preg_replace('/;*\s*\?>/', '; ?>', str_replace('<?=', '<?php echo ', file_get_contents($view))));
        } else {
            include($view);
        }
    }
}
