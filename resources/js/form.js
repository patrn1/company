(function () {
    document.addEventListener('change',function(evt){
        var target = evt.target;
        if (target.matches("[type='file']")) {
            var fileName = target.files[ 0 ].name;
            var labelList = target.parentNode.getElementsByClassName("custom-file-label");
            var label = labelList[ 0 ];
            label.innerText = fileName;
        }
    });
})();
