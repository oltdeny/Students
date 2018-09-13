<template>
    <div class="range">
        <label for="'avg' + parameters.id">Average mark for {{parameters.name}}</label>
        <input type="text" id="'avg' + parameters.id" readonly style="border:0; color:#f6931f; font-weight:bold;">
        <div id="'slider' + parameters.id"></div>
    </div>
</template>
<script>
    jQuery.noConflict();
    export default {
        props: [
            'parameters'
        ],
        methods: {
            customSlider: function () {
                console.log(this.parameters.name);
                jQuery( function($) {
                    $( "#slider" + this.parameters.name).slider({
                        range: true,
                        min: 0,
                        max: 5,
                        values: [this.parameters.min, this.parameters.max],
                        step: 0.1,
                        slide: function( event, ui ) {
                            $( "#avg" + this.parameters.id).val( ui.values[ 0 ] + "-" + ui.values[ 1 ] );
                        }
                    });
                } );
            }
        },
        mounted() {
            this.customSlider();
        },
    }
</script>
