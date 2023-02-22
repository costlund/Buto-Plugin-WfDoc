<?php
class PluginWfDoc{
  public function __call($method, $args) {
    wfPlugin::includeonce('wf/array');
    /**
     * Default folders.
     */
    $settings = new PluginWfArray(array('page_folder' => 'page', 'layout_folder' => 'layout'));
    /**
     * Get theme settings for this page.
     */
    $theme_settings = new PluginWfArray(wfArray::get($GLOBALS, 'sys/settings/plugin_modules/'.wfArray::get($GLOBALS, 'sys/class').'/settings'));
    if($theme_settings->get()){
      /**
       * Merge theme settings with defaults.
       */
      $settings = new PluginWfArray(array_merge($settings->get(), $theme_settings->get()));
    }
    /**
     * Removing the "page_" prefix.
     */
    $method = substr($method, 5);
    /**
     * 
     */
    $filename = wfArray::get($GLOBALS, 'sys/theme_dir').'/'.$settings->get('page_folder').'/'.$method.'.yml';
    if(file_exists($filename)){
      $page = sfYaml::load($filename);
      wfArray::set($GLOBALS, 'sys/filename', $filename);
      wfArray::set($GLOBALS, 'sys/layout_path', '/theme/'.wfArray::get($GLOBALS, 'sys/theme').'/'.$settings->get('layout_folder'));
      wfDocument::mergeLayout($page);
    }else{
      wfEvent::run('page_not_found', array('description' => 'PluginWfDoc could not find the file '.$settings->get('page_folder').'/'.$method.'.yml.', 'plugin' => wfArray::get($GLOBALS, 'sys/plugin'), 'class' => wfArray::get($GLOBALS, 'sys/class'), 'method' => $method, 'filename' => $filename));
    }
  }
}
