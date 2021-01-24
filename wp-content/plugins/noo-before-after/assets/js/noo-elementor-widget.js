( function( $ ) {

    var NooImageComparisonBeforeAfter = function($scope, $) {
        var obj = $scope.find('.noo-inner');
        obj.each(function() {
            var curItem = $(this);
            var data = {};
            data.direction = curItem.data('direction');
            data.type = curItem.data('type');
            data.offset = curItem.data('offset');
            data.before_label = curItem.data('before_label');
            data.after_label = curItem.data('after_label');

            curItem.nooImageComparison({
                control_offset: data.offset,
                direction: data.direction,
                before_label: data.before_label,
                after_label: data.after_label,
                comparison_type: data.type,
            });

        });
    }
    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/noo-before-after.default', NooImageComparisonBeforeAfter);
    } );
} )( jQuery );
