(function ($) {
  $.fn.countTo = function (options) {
    options = options || {};

    return $(this).each(function () {
      // Cache $(this) to avoid multiple jQuery lookups
      var $self = $(this);

      // Set options for the current element
      var settings = $.extend(
        {},
        $.fn.countTo.defaults,
        {
          from: $self.data("from"),
          to: $self.data("to"),
          speed: $self.data("speed"),
          refreshInterval: $self.data("refresh-interval"),
          decimals: $self.data("decimals"),
        },
        options
      );

      // Calculate number of loops and increment per loop
      var loops = Math.ceil(settings.speed / settings.refreshInterval),
        increment = (settings.to - settings.from) / loops;

      // References & initial value
      var value = settings.from,
        data = $self.data("countTo") || {};

      $self.data("countTo", data);

      // Clear existing interval if any
      if (data.interval) {
        clearInterval(data.interval);
      }

      // Start the interval to update the counter
      data.interval = setInterval(updateTimer, settings.refreshInterval);

      // Initialize with the starting value
      render(value);

      function updateTimer() {
        value += increment;

        render(value);

        // Stop when completed
        if (value >= settings.to) {
          $self.removeData("countTo");
          clearInterval(data.interval);
          value = settings.to;

          // Call onComplete if defined
          if (typeof settings.onComplete === "function") {
            settings.onComplete.call($self[0], value);
          }
        }
      }

      function render(value) {
        var formattedValue = settings.formatter(value, settings);
        $self.html(formattedValue);
      }
    });
  };

  // Default settings
  $.fn.countTo.defaults = {
    from: 0,
    to: 0,
    speed: 1000,
    refreshInterval: 100,
    decimals: 0,
    formatter: function (value, settings) {
      return value.toFixed(settings.decimals);
    },
    onComplete: null, // Optional: Callback on complete
  };
})(jQuery);

jQuery(function ($) {
  // Start all the counters
  $(".timer").each(function () {
    var $this = $(this);
    var options = $.extend({}, $this.data("countToOptions") || {});
    $this.countTo(options);
  });
});
