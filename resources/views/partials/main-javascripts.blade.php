<script>
$(document).ready(function () {
  window._token = $('meta[name="csrf-token"]').attr("content");

  var allEditors = document.querySelectorAll(".ckeditor");
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(allEditors[i]);
  }
  
  var localeString = "{{ config('panel.primary_language') }}";

    moment.updateLocale(localeString, {
        week: { dow: 1 }, // Monday is the first day of the week
    });

    $(".date").datetimepicker({
        format: "YYYY-MM-DD",
        locale: localeString,
        maxDate: moment(),
        useCurrent: false
    });

    $(".datetime").datetimepicker({
        format: "YYYY-MM-DD HH:mm",
        locale: localeString,
        maxDate: moment(),
        sideBySide: true,
    });

    $(".timepicker").datetimepicker({
        format: "HH:mm",
    });

    $(".select-all").click(function () {
        let $select2 = $(this).parent().siblings(".select2");
        $select2.find("option").prop("selected", "selected");
        $select2.trigger("change");
    });
    $(".deselect-all").click(function () {
        let $select2 = $(this).parent().siblings(".select2");
        $select2.find("option").prop("selected", "");
        $select2.trigger("change");
    });

    $(".select2").select2();

    $(".treeview").each(function () {
        var shouldExpand = false;
        $(this)
            .find("li")
            .each(function () {
                if ($(this).hasClass("active")) {
                    shouldExpand = true;
                }
            });
        if (shouldExpand) {
            $(this).addClass("active");
        }
    });
});
</script>