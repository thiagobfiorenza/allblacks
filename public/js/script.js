$(document).ready(function() {
    $('input[name="document"]').mask('000.000.000-00');
    $('input[name="postcode"]').mask('00000-000');

    $telephone = $('input[name="telephone"]');
    $telephone.mask('(00) 90000-0000').on('blur', function(){
        if ($(this).val().length == '14') {
            $(this).mask('(00) 0000-0000')
        }
    }).on('focus', function(){
        $(this).mask('(00) 90000-0000')
    });
    if ($telephone.val().length == '14') {
        $telephone.mask('(00) 0000-0000')
    }
    $('input[name="email"]').mask("A", {
        translation: {
            "A": { pattern: /[\w@\-.+]/, recursive: true }
        }
    });
});