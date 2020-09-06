<?php
/**
 * Created by PhpStorm.
 * User: elvis
 * Date: 04.10.2018
 * Time: 8:59
 */

namespace myshop;


class Cache
{
    use TSingleton;

    /**
     * @return mixed
     */
    public function get($key)
    {
        $file = CACHE . '/' . md5($key) . 'txt';
        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['end_time'])
                return $content;
            unlink($file);
        }
        return false;
    }

    /**
     * @param mixed $instance
     */
    public function set($key, $data, $seconds = 3600)
    {
        if ($seconds) {
            $content['data'] = $data;
            $content['end_time'] = time() + $seconds;
            if (file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize($content)))
                return true;
        }
        return false;

    }

    public function delete($instance): void
    {
        $file = CACHE . '/' . md5($key) . 'txt';
        if (file_exists($file)) {
            unlink($file);
        }
    }


}