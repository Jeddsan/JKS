window.onload = loader();

function loader(){
    var elements_tohighlight = document.getElementsByClassName("jks-syntax-highlight");
    for (var i = 0; i < elements_tohighlight.length; i++) {
        jks_syntax_highlight(elements_tohighlight[i]);
    }
}

function jks_syntax_highlight(element){
    var content = element.innerHTML;

    // Variables
    content = content.replace(/(?:var )([a-zA-Z_]+[ ]*)(?:;)/g,
        "<span style=\"color: #40c4ff\">var </span><span style=\"color: #8bc34a\">$1</span><span style=\"color: #40c4ff\">;</span>");
    content = content.replace(/(?:var )([a-zA-Z_]+[ ]*=.+)(?:;)/g,
        "<span style=\"color: #40c4ff\">var </span><span style=\"color: #8bc34a\">$1</span><span style=\"color: #40c4ff\">;</span>");

    // Functions
    content = content.replace(/(jks_[a-zA-Z_]*[ ]*\(.*\)[ ]*;)/g,"<span style=\"color: #1565c0\">$1</span>");
    content = content.replace(/(\(.*\))/g,"<span style=\"color: #8bc34a\">$1</span>");
    content = content.replace(/(\(|\)|,)/g,"<span style=\"color: #bdbdbd\">$1</span>");

    // General
    content = content.replace(/(;)/g,";<br>");

    element.innerHTML = content;
}
