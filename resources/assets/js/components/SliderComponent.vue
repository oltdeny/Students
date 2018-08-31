<template>
    <div class="col">
        <label for="avg{{parameters.id}}">Average mark for {{parameters.name}}</label>
        @if(isset($request->{'avg' . $subject->id}))
        <input type="text" id="avg{{parameters.id}}" name="avg{{parameters.id}}" value="@php echo $request->{'avg'.$subject->id}; @endphp" readonly style="border:0; color:#f6931f; font-weight:bold;">
        @else
        <input type="text" id="avg{{parameters.id}}" name="avg{{parameters.id}}" readonly style="border:0; color:#f6931f; font-weight:bold;">
        @endif
        <div id="slider{{parameters.id}}"></div>
    </div>
</template>

<script>
    jQuery.noConflict();
    export default {
        props: [
            'parameters'
        ],
        mounted() {

        },
        methods: {
            slider: jQuery( function($) {
                $( "#slider" ).slider({
                    range: true,
                    min: 0,
                    max: 5,
                    values: [parameters[0], parameters[1]],
                    step: 0.1,
                    slide: function( event, ui ) {
                        $( "#avg".parameters.id ).val( ui.values[ 0 ] + "-" + ui.values[ 1 ] );
                    }
                });
            } );
        }
    }
</script>

<style scoped>

</style>