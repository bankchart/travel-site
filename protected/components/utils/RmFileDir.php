<?php

class RmFileDir
{
    public function recursiveRmDirectory($directory)
    {
        foreach(glob("{$directory}/*") as $file){
            if(is_dir($file)){
                recursiveRmDirectory($file);
            }else{
                unlink($file);
            }
        }
        if(is_dir($directory)) rmdir($directory);
    }
}

?>
