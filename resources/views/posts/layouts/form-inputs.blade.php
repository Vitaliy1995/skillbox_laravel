<div class="form-group">
    <label for="name">Название статьи</label>
    <input type="text"
           class="form-control"
           id="name"
           name="name"
           minlength="5"
           maxlength="100"
           value="{{ old('name', isset($article) ? $article->name : '') }}"
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
           value="{{ old('annotation', isset($article) ? $article->annotation : '') }}"
           required
    >
</div>
<div class="form-group">
    <label for="description">Текст статьи</label>
    <textarea name="description" id="description" class="col-md-12" rows="10" required>{{ isset($article) ? $article->description : '' }}</textarea>
</div>
<div class="form-group">
    <label for="tags">Теги статьи</label>
    <input type="text"
           name="tags"
           id="tags"
           class="form-control"
           value="{{ old('tags', isset($article) ? $article->tags->pluck('name')->implode(',') : '') }}"
    />
</div>
<div class="form-group form-check">
    <input type="checkbox"
           class="form-check-input"
           id="published"
           name="published"
           @if (old('published', isset($article) ? ($article->published ? 'on' : '') : '') === 'on')
           checked
           @endif
    >
    <label class="form-check-label" for="published">Опубликовать</label>
</div>
<button type="submit" class="btn btn-primary">Сохранить</button>
