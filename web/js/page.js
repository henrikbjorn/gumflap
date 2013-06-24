var Gumflap = function (pusher, form, content) {
    this.pusher  = pusher;
    this.channel = pusher.subscribe('gumflap');
    this.form    = form;
    this.content = content;
};

Gumflap.prototype = {
    initialize : function () {
        this.form.on('submit', $.proxy(this.onSubmit, this));

        this.channel.bind('message', $.proxy(this.onPusherMessage, this));
    },

    postMessage : function () {
        var action = this.form.attr('action');

        $.post(action, this.form.serialize(), $.proxy(this.onMessagePosted, this));
    },

    onPusherMessage : function (message) {
        this.content.append('<p><strong>' + message[1] + '</strong>&nbsp;' + message[0]);
    },

    onMessagePosted : function (data, textStatus) {
        this.form.find('input[name="message"]').val('').focus();
    },

    onSubmit : function (e) {
        e.preventDefault();

        this.postMessage();
    }
};
