<div class="form-group">
    <label for="name">Название статьи</label>
    <input type="text"
           class="form-control"
           id="name"
           name="name"
           minlength="5"
           maxlength="100"
           value="{{ old('name', $article->name) }}"
           required
    >
</div>
<div class="form-group">
    <label for="annotation">Краткое описание статьи</label>
    <input type="text"
           class="form-control"
           id="annotation"
           name="annotation"
           maxlength="255"
           value="{{ old('annotation', $article->annotation) }}"
           required
    >
</div>
<div class="form-group">
    <label for="description">Текст статьи</label>
    <textarea name="description" id="description" class="col-md-12" rows="10" required>{{ old('description',  $article->description) }}</textarea>
</div>
<div class="form-group">
    <label for="tags">Теги статьи</label>
    <input type="text"
           name="tags"
           id="tags"
           class="form-control"
           value="{{ old('tags', $article->tags->pluck('name')->implode(',')) }}"
    />
</div>
<div class="form-group form-check">
    <input type="checkbox"
           class="form-check-input"
           id="published"
           name="published"
           @if (old('published', ($article->published ? 'on' : '')))
           checked
           @endif
    >
    <label class="form-check-label" for="published">Опубликовать</label>
</div>
<button type="submit" class="btn btn-primary">Сохранить</button>
