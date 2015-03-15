
$ ->
    $('body > footer > nav > ul').append $('<li><div>Hello from CoffeScript</div></li>')
    $('form[data-ajax]').on 'submit', (event) ->
        event.preventDefault()
        form = $(this).closest 'form'
        $.ajax form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: (xhr, status, data) ->
                console.log status, data.responseJSON
                reload = form.data('reload')
                if reload
                    # TODO: ajax reload
                    window.location.reload()
            error: (xhr, status) ->
                alert status
        return false
    $('[data-action]').on 'click', (event) ->
        event.preventDefault()
        self = $(this)
        action = self.data('action')
        container = self.closest '[data-ajax]'
        element = self.closest '[data-id]'
        uri = container.data 'ajax'
        data = $.extend(container.data(), element.data(), self.data())
        # tmp hack
        # todo: send request to server & validate request
        #       return complete info for object
        if action == 'edit'
            $('[data-editor]', element).each ->
                $(this).data 'html', $(this).html()
            $('[data-editor]', element).attr 'contenteditable', true
            return
        else if action == 'cancel'
            $('[data-editor]', element).each ->
                $(this).html $(this).data('html')
            $('[data-editor]', element).removeAttr 'contenteditable'
            return
        else if action == 'update'
            data.post = {}
            $('[data-key]', element).each ->
                data.post[$(this).data 'key'] = if $(this).data('editor') == 'wysiwyg' then $(this).html() else $(this).text()
            console.log 'update data: ', data
        xhr = $.ajax uri,
            method: action
            data: data
            dataType: 'json'
            success: (xhr, status, data) ->
                console.log status, data.responseJSON
                if action == 'delete'
                    # todo, delete if server response says so, not action
                    element.remove()
            error: (xhr, status) ->
                console.log xhr
                console.log status, xhr.responseText
                alert status
        xhr.always = ->
            $('[data-editor]', element).removeAttr 'contenteditable'
    $('#compile').on 'click', (event) ->
        fn = haml.compileHaml sourceId: 'template'
        html = fn '$title': "<u>Coffeh!</u>"
        $('#output').html html
    $('#compile').click()
    $(document).on 'hui-touchmenu-init', (event, menu) ->
        menu.element.removeClass 'horizontal'

    $(document).on 'click', '[href="#toggle-admin"]', (event) ->
        $('html').toggleClass('admin')
        return false