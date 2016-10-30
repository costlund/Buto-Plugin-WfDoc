<?php
/**
<p>
Render pages from theme page folders.
</p>
<p>
Example of usage. Param p can be anything and will represent /p/name_of_page in page request.
</p>
<p>One could use this multiple times in theme by changing the parmas settings/page_folder and settings/layout_folder.</p>
#code-yml#
plugin_modules:
  p:
    plugin: 'wf/doc'
    settings:
      page_folder: Set this if want to use other than page as folder.
      layout_folder: Set this if want to use other than layout as folder.
#code#
 */
class PluginWfDoc{
  public function __call($method, $args) {
    wfPlugin::includeonce('wf/array');
    /**
     * Default folders.
     */
    $settings = new PluginWfArray(array('page_folder' => 'page', 'layout_folder' => 'layout'));
    
    /**
     * Get theme settings.
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
    $filename = wfArray::get($GLOBALS, 'sys/theme_dir').'/'.$settings->get('page_folder').'/'.$method.'.yml';
    if(file_exists($filename)){
      $page = sfYaml::load($filename);
      wfArray::set($GLOBALS, 'sys/layout_path', '/theme/'.wfArray::get($GLOBALS, 'sys/theme').'/'.$settings->get('layout_folder'));
      wfDocument::mergeLayout($page);
    }else{
      wfEvent::run('page_not_found', array('description' => 'Yml file for page does not exist in folder '.$settings->get('page_folder').'.', 'plugin' => wfArray::get($GLOBALS, 'sys/plugin'), 'class' => wfArray::get($GLOBALS, 'sys/class'), 'method' => $method, 'filename' => $filename));
    }
  }
}
