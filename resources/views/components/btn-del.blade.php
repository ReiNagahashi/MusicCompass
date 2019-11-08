@php
    $id_attr = 'modal-delete-' . $controller . '-' . $id; 
    // このidの記述の意味は同じページに複数の削除ボタンが作られることを想定した上でそれぞれをユニークの属性にしている
@endphp

{{-- 削除ボタン --}}
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{ $id_attr }}">
  {{ __('Delete') }}
</button>

{{-- モーダルウィンドウ --}}
<div class="modal fade" id="{{ $id_attr }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id_attr }}-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id_attr }}-label">
                    {{ __('Confirm delete') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <p>{{ __('本当に削除してもよろしいですか?') }}</p>
                <p><strong>{{ $name }}</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('Cancel') }}
                </button>
                {{-- 削除用のアクションを実行させるフォーム --}}
                <form action="{{ url($controller . '/' . $id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>