<?php

class Blog
{
    public function scan($path, &$blogs = array())
    {
        $lists = scandir($path);

        if (!empty($lists)) {
            foreach($lists as $file) {
                if (is_dir($path . '/' . $file) && $file != '.' && $file != '..') {
                    $this->scan($path . '/' . $file, $blogs);
                } else {
                    if ($file != '..' && $file != '.' && $file != 'index.php' && $file != 'index.twig') {
                        if (preg_match('/\/content(\/[0-9a-z-\/]+)/', $path, $matches)) {
                            $blogs[] = [
                                'path' => $matches[1] . '/' . str_replace('.twig', '.html', $file),
                                'title' => ucfirst(str_replace(['.twig', '-'], ['', ' '], $file))
                            ];
                        }
                    }
                }
            }
        }
        return $blogs;
    }

    public function getIndex() {

        $out = ['blogs' => []];

        foreach ($this->scan(__DIR__) as $entry) {
            $out['blogs'][] = $entry;
        }

        return $out;
    }
}

return (new Blog)->getIndex();
