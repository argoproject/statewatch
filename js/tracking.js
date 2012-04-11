jQuery(document).ready(function($) {
    
    /***
    Click events are configured by adding an array of objects to the window
    object called `_clickEvents`. The included objects should include attributes
    called `selector` that jQuery can use to find the elements you're tracking,
    plus a `category` used by Google Analytics to namespace events.
    
    For example:
        var _clickEvents = [
            {category: 'a.trackme', category: 'Links I want to track'}
        ]
    
    trackArray: ['_trackEvent', category, action, label, value, non-interact]

    ***/
    var events = window._clickEvents || [];
    
    $.each(events, function(i) {
        var selector = this.selector,
            category = this.category,
            action   = this.action,
            label    = this.label,
            value    = this.value
        
        $(selector).each(function(i) {
            var trackArray = [
                '_trackEvent', 
                category, 
                action || $(this).text().trim(), 
                label  || $(this).attr('href'), 
                value  || 1, 
                true
            ];
            
            $(this).click(function(e) {
                _gaq.push(trackArray);
            });
        });
    });
});