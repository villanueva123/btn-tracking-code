'use strict';
 (function($){
    $(function(){
        if( $('#tracking_wp_head_content').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2
                }
            );
            var editor = wp.codeEditor.initialize( $('#tracking_wp_head_content'), editorSettings );
        }

        if( $('#tracking_opening_content').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2,
                    
                }
            );
            var editor = wp.codeEditor.initialize( $('#tracking_opening_content'), editorSettings );
        }

        if( $('#tracking_closing_content').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2,

                }
            );
            var editor = wp.codeEditor.initialize( $('#tracking_closing_content'), editorSettings );
        }
    });
 })(jQuery);
