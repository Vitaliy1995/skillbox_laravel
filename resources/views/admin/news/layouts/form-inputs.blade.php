<div class="form-group">
    <label for="name">Название новости</label>
    <input type="text"
           class="form-control"
           id="title"
           name="title"
           minlength="3"
           maxlength="255"
           value="{{ old('title', $news->title) }}"
           required
    >
</div>
<div class="form-group">
    <label for="annotation">Текст новости</label>
    <textarea class="form-control"
           id="description"
           name="description"
           required
    >{{ old('description', $news->description) }}</textarea>
</div>
<div class="form-group">
    <label for="tags">Теги новости</label>
    <input type="text"
           name="tags"
           id="tags"
           class="form-control"
           value="{{ old('tags', $news->tags->pluck('name')->implode(',')) }}"
    />
</div>
<div class="form-group form-check">
    <input type="checkbox"
           class="form-check-input"
           id="published"
           name="published"
           @if (old('published', ($news->published ? 'on' : '')))
               checked
            @endif
    >
    <label class="form-check-label" for="published">Опубликовать</label>
</div>
<button type="submit" class="btn btn-primary">Сохранить</button>
