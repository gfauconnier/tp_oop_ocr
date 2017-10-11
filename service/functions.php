<?php

function loadClasses($classname)
{
    require 'entities/'.$classname.'.php';
}

spl_autoload_register('loadClasses');
