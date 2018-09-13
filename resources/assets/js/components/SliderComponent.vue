<template>
    <div class="col">
        <label>Average mark for {{parameters.name}}
            <input type="text" :id="'avg' +  parameters.id" :name="'avg' +  parameters.id" :value="parameters.0 + '-' + parameters.1" readonly style="border:0; color:#f6931f; font-weight:bold;">
        </label>
        <div :id="'slider' + parameters.id"></div>
    </div>
</template>

<script>
    jQuery.noConflict();
    export default {
        props: [
            'parameters'
        ],
        mounted() {
            this.slider()
        },
        methods: {
            slider: function () {
                parameters = this.parameters;
                jQuery( function($) {
                    $( "#slider".parameters.id ).slider({
                        range: true,
                        min: 0,
                        max: 5,
                        values: [parameters[0], parameters[1]],
                        step: 0.1,
                        slide: function( event, ui ) {
                            $( "#avg".parameters.id ).val( ui.values[ 0 ] + "-" + ui.values[ 1 ] );
                        }
                    });
                } )
            }
        }
    }
</script>

<style scoped>

</style>