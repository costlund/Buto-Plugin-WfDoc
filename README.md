# Buto-Plugin-WfDoc



<a name="key_0"></a>

## Settings

<p>Render pages from /theme/my/theme/page folder.</p>
<p>Param p can be anything and will represent /p/name_of_page in page request.</p>
<pre><code>plugin_modules:
  p:
    plugin: 'wf/doc'
    settings:</code></pre>
<p>Set page_folder (optional, default is page).</p>
<pre><code>      page_folder: page2 (folder in same dir as theme)
      page_folder: '[app_dir]/../buto_data/theme/[theme]/[tag]/pages' (folder outside buto app folder)</code></pre>
<p>Set layout_folder (optional).</p>
<pre><code>      layout_folder: Set this if want to use other layout folder then on current theme.</code></pre>
<p>Start page registration.</p>
<pre><code>default_class: p
default_method: home</code></pre>
<p>If page not found one could add a page for that. Otherwise a link to start page is shown. If this page not exist an error is thrown.</p>
<pre><code>default_method_not_exist: not_exist</code></pre>

<a name="key_1"></a>

## Usage



<a name="key_2"></a>

## Pages



<a name="key_3"></a>

## Widgets



<a name="key_4"></a>

## Event



<a name="key_5"></a>

## Construct



<a name="key_6"></a>

## Methods



<a name="key_6_0"></a>

### __call

<p>All page requests are through this method.</p>

