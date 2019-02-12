# Buto-Plugin-WfDoc

Render pages from /theme/my/theme/page folder.

Param p can be anything and will represent /p/name_of_page in page request.

```
plugin_modules:
  p:
    plugin: 'wf/doc'
    settings:
      page_folder: Set this if do not want to use default page folder.
      layout_folder: Set this if want to use other layout folder then on current theme.
```
