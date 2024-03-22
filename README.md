# Buto-Plugin-WfDoc
Render pages from /theme/my/theme/page folder.

Param p can be anything and will represent /p/name_of_page in page request.
```
plugin_modules:
  p:
    plugin: 'wf/doc'
    settings:
```
Set page_folder (optional, default is page).
```
      page_folder: page2 (folder in same dir as theme)
      page_folder: '[app_dir]/../buto_data/theme/[theme]/[tag]/pages' (folder outside buto app folder)
```
Set layout_folder (optional).
```
      layout_folder: Set this if want to use other layout folder then on current theme.
```
