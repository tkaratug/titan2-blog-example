<link rel="stylesheet" href="{{ get_asset('backend/plugins/sweetAlert/sweetalert.css') }}">

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><i class="fa fa-edit"></i> Kategori Düzeltme</h4>
</div>

{!! Form::open(['id' => 'saveCategory']) !!}

<div class="modal-body clearfix">

    <div class="form-group">
        {!! Form::label('categoryName', 'Kategori Adı') !!}
        {!! Form::text('categoryName', ['class' => 'form-control', 'id' => 'categoryName', 'value' => $category->categoryName]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('categorySlug', 'Sef URL') !!}
        {!! Form::text('categorySlug', ['class' => 'form-control', 'id' => 'categorySlug', 'value' => $category->categorySlug]) !!}
    </div>

    {!! Form::hidden('_token', ['value' => csrf_token()]) !!}

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default btnload" data-dismiss="modal" id="cancel">Kapat</button>
    <button type="submit" class="btn btn-success btnload" id="save"><i class="fa fa-save"></i> Kaydet</button>
</div>

{!! Form::close() !!}

<script src="{{ get_asset('backend/plugins/sweetAlert/sweetalert.min.js') }}"></script>
<script type="text/javascript">

    $('#saveCategory').on('submit', function(e){
        e.preventDefault();

        // Disable Buttons
        $('.btnload').attr('disabled', true);

        if ($('#categoryName').val() == '') {
            swal({
                title: "Uyarı!",
                text: "Lütfen kategori adı girin.",
                type: "error",
                confirmButtonText: "Tamam"
            });
            // Enable Buttons
            $('.btnload').attr('disabled', false);
            return false;
        } else if ($('#categorySlug').val() == '') {
            swal({
                title: "Uyarı!",
                text: "Lütfen kategori için sef url girin.",
                type: "error",
                confirmButtonText: "Tamam"
            });
            // Enable Buttons
            $('.btnload').attr('disabled', false);
            return false;
        }

        $.ajax({
            url: "{{ link_to('backend/categories/update/' . $category->categoryId) }}",
            method: "post",
            data: $('#saveCategory').serialize(),
            success: function(data)
            {
                var response = JSON.parse(data);
                if (response.code == 1) {
                    swal({
                        title: "Tamamlandı!",
                        text: "Kategori güncellendi.",
                        type: "success",
                        confirmButtonText: "Tamam"
                    },
                    function(isConfirm){
                        location.reload();
                    });
                } else {
                    swal({
                        title: "Uyarı!",
                        text: response.msg,
                        type: "error",
                        confirmButtonText: "Tamam"
                    });
                    // Enable Buttons
                    $('.btnload').attr('disabled', false);
                }
            },
            error: function(data)
            {
                swal({
                    title: "Uyarı!",
                    text: "Kategori güncellenirken bir hata oluştu.",
                    type: "error",
                    confirmButtonText: "Tamam"
                });
                // Enable Buttons
                $('.btnload').attr('disabled', false);
            }
        });
    });

</script>
