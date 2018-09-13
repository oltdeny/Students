<template>
    <div class="range">
        <label for="'avg' + parameters.id">Average mark for {{parameters.name}}</label>
        <input type="text" id="'avg' + parameters.id" readonly style="border:0; color:#f6931f; font-weight:bold;">
        <div id="'slider' + parameters.id"></div>
    </div>
</template>
<script>
    var slider = document.getElementById('slider'+id);
    noUiSlider.create(slider, {
        start: [min, max],
        connect: true,
        range: {
            'min': min,
            'max': max
        },
        step: 0.1
    });
    export default {
        props: [
            'parameters'
        ],
        methods: {
            customSlider: function () {
                // jQuery.noConflict();
                var min = this.parameters.min;
                var max = this.parameters.max;
                var id = this.parameters.id;
                // jQuery( function($) {
                //     $( "#slider" + name).slider({
                //         range: true,
                //         min: 0,
                //         max: 5,
                //         values: [min, max],
                //         step: 0.1,
                //         slide: function( event, ui ) {
                //             $( "#avg" + id).val( ui.values[ 0 ] + "-" + ui.values[ 1 ] );
                //         }
                //     });
                // } );

            }
        },
        mounted() {
            this.customSlider();
        },
    }
</script>
