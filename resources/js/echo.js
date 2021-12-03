Echo.private('article-update')
    .listen('ArticleUpdate', (e) => {
        alert(`Название: ${e.name}, измененные поля: ${e.changes}, ссылка: ${e.link}`);
    });
