<?php
class PluginWfDoc{
  public function __call($method, $args) {
    wfPlugin::includeonce('wf/array');
    /**
     * Default folders.
     */
    $settings = new PluginWfArray(array('page_folder' => wfGlobals::get('theme_dir').'/'.'page', 'layout_folder' => 'layout'));
    /**
     * Get theme settings for this page.
     */
    $theme_settings = new PluginWfArray(wfGlobals::get('settings/plugin_modules/'.wfGlobals::get('class').'/settings'));
    if($theme_settings->get('page_folder')){
      if(substr($theme_settings->get('page_folder'), 0, 1)!='['){
        $theme_settings->set('page_folder', wfGlobals::get('theme_dir').'/'.$theme_settings->get('page_folder'));
      } 
    }
    if($theme_settings->get()){
      /**
       * Merge theme settings with defaults.
       */
      $settings = new PluginWfArray(array_merge($settings->get(), $theme_settings->get()));
    }
    /**
     * Removing the "page_" prefix.
     */
    $method = wfPhpfunc::substr($method, 5);
    /**
     * 
     */
    $filename = $settings->get('page_folder').'/'.$method.'.yml';
    $filename = wfSettings::replaceDir($filename);
    /**
     * default_method_not_exist
     */
    if(!file_exists($filename) && wfGlobals::get('settings/default_method_not_exist')){
      $method = wfGlobals::get('settings/default_method_not_exist');
      $filename = $settings->get('page_folder').'/'.$method.'.yml';
      $filename = wfSettings::replaceDir($filename);
      if(!file_exists($filename)){
        throw new Error(__CLASS__." says: Page $filename does not exist!");
      }
    }
    /**
     * 
     */
    if(file_exists($filename)){
      $page = sfYaml::load($filename);
      wfGlobals::set('filename', $filename);
      wfGlobals::setSys('layout_path', '/theme/'.wfGlobals::get('theme').'/'.$settings->get('layout_folder'));
      wfDocument::mergeLayout($page);
    }else{
      wfEvent::run('page_not_found', array('description' => 'PluginWfDoc could not find the file '.$settings->get('page_folder').'/'.$method.'.yml.', 'plugin' => wfGlobals::get('plugin'), 'class' => wfGlobals::get('class'), 'method' => $method, 'filename' => $filename));
    }
  }
}
