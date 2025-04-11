<?php
use yii\helpers\Html;
use yii\helpers\Url;
// use mihaildev\elfinder;
// use mihaildev\elfinder\InputFile;
// use yii\web\JsExpression;
// use yii\widgets\ActiveForm;
// use mihaildev\elfinder\Assets;

// Elfinder Css
$this->registerCssFile('@web/dist/elfinder/css/commands.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/dist/elfinder/css/common.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/dist/elfinder/css/contextmenu.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/dist/elfinder/css/cwd.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/dist/elfinder/css/dialog.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/dist/elfinder/css/fonts.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/dist/elfinder/css/navbar.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/dist/elfinder/css/places.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/dist/elfinder/css/quicklook.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/dist/elfinder/css/statusbar.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/dist/elfinder/css/theme.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/dist/elfinder/css/toast.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/dist/elfinder/css/toolbar.css', ['depends' => [\yii\web\JqueryAsset::className()]]);


// Elfinder Jquery
$this->registerCssFile('@web/dist/elfinder/jquery/jquery-ui-1.12.0.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/jquery/jquery-1.12.4.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/jquery/jquery-ui-1.12.0.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

// Elfinder Core
$this->registerJsFile('@web/dist/elfinder/js/elFinder.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/elFinder.version.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/jquery.elfinder.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/elFinder.mimetypes.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/elFinder.options.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/elFinder.options.netmount.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/elFinder.history.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/elFinder.command.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/elFinder.resources.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

// Elfinder Dialog
$this->registerJsFile('@web/dist/elfinder/js/jquery.dialogelfinder.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/i18n/elfinder.en.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


// Elfinder UI
$this->registerJsFile('@web/dist/elfinder/js/ui/button.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/contextmenu.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/cwd.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/dialog.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/fullscreenbutton.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/navbar.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/navdock.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/overlay.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/panel.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/path.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/places.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/searchbutton.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/sortbutton.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/stat.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/toast.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/toolbar.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/tree.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/uploadButton.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/viewbutton.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/ui/workzone.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

// Elfinder Commands
$this->registerJsFile('@web/dist/elfinder/js/commands/archive.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/back.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/chmod.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/colwidth.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/copy.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/cut.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/download.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/duplicate.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/edit.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/empty.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/extract.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/forward.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/fullscreen.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/help.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/hidden.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/hide.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/home.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/info.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/mkdir.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/mkfile.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/netmount.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/open.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/opendir.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/opennew.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/paste.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/places.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/preference.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/quicklook.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/quicklook.plugins.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/reload.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/rename.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/resize.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/restore.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/rm.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/search.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/selectall.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/selectinvert.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/selectnone.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/sort.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/undo.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/up.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/upload.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/elfinder/js/commands/view.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

// Elfinder connector version 1.x API
$this->registerJsFile('@web/dist/elfinder/js/proxy/elFinderSupportVer1.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

// Elfinder content editor
$this->registerJsFile('@web/dist/elfinder/js/extras/editors.default.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

// GoogleDocs Plugin quicklook for google drive
$this->registerJsFile('@web/dist/elfinder/js/extras/quicklook.googledocs.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->params['breadcrumbs'][] = ['label' => 'EOD Sales TKP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->title = 'EOD Sales TKP';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card table-card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
			<div class="eod-sales-tkp">
				<div class="row">
					<div class="col">
                        <div id="elFinder"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$url = Url::base().'/dist/elfinder/php/connector.maximal.php';
$js = <<< JS
$('#elFinder').elfinder(
    {
        // Disable CSS auto loading
        cssAutoLoad : false,
        // Base URL to css/*, js/*
        baseUrl : './',
        // Connector URL
        url : '$url',
        
        // Callback when a file is double-clicked
        getFileCallback : function(file) {
            // ...
            alert(file);
        },
    },
    // 2nd Arg - before boot up function
    function(fm, extraObj) {
        // `init` event callback function
        fm.bind('init', function() {
            // Optional for Japanese decoder "extras/encoding-japanese.min"
            delete fm.options.rawStringDecoder;
            if (fm.lang === 'ja') {
                fm.loadScript(
                    [ fm.baseUrl + 'js/extras/encoding-japanese.min.js' ],
                    function() {
                        if (window.Encoding && Encoding.convert) {
                            fm.options.rawStringDecoder = function(s) {
                                return Encoding.convert(s,{to:'UNICODE',type:'string'});
                            };
                        }
                    },
                    { loadType: 'tag' }
                );
            }
        });
        
        // Optional for set document.title dynamically.
        var title = document.title;
        fm.bind('open', function() {
            var path = '',
                cwd  = fm.cwd();
            if (cwd) {
                path = fm.path(cwd.hash) || null;
            }
            document.title = path? path + ':' + title : title;
        }).bind('destroy', function() {
            document.title = title;
        });
    }
)

JS;

$css = <<< CSS

CSS;

$this->registerCss($css);
$this->registerJs($js);

?>