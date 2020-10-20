(function($){
    $(function(){
        var confettiElement = document.getElementById('techgnosis-canvas');
        var confettiSettings = { 
            target: confettiElement,
            colors : tgObj.colors,
            max: tgObj.max,
            size: tgObj.size,
            animate: tgObj.animate,
            clock: tgObj.clock,
            respawn: tgObj.respawn,
            rotate: tgObj.rotate,
            start_from_edge: false,
            props: []
        };

        if( tgObj.shapes.length ){
            for( var i = 0; i < tgObj.shapes.length; i++){
                confettiSettings.props.push( tgObj.shapes[i] );
            }
        }

        if(tgObj.svg){
            confettiSettings.props.push({ 
                type: "svg", 
                src: "/wp-content/plugins/techgnosis-confetti/svgs/"+tgObj.svg,
                weight: 1, 
                size: 20
            });
        }

        var confetti = new ConfettiGenerator(confettiSettings);
        confetti.render();

        if( tgObj.modal ){
            setTimeout(function(){
                $('#open-modal').addClass("open");
            }, tgObj.popupDelay);

            $('body').on( 'click', '.modal-close, canvas', function(){
                $('#open-modal').removeClass('open');
                confetti.clear();
            });
        }
        
    });
}(jQuery))