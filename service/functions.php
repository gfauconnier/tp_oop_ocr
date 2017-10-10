<?php

function loadClasses($classname)
{
    require 'service/'.$classname.'.php';
}

spl_autoload_register('loadClasses');
