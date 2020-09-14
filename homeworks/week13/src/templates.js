/* eslint-disable */
export const cssTemplate = 'body { background: #426281; } label {color: #eee; font-size: 1.75rem; font-weight: bold}'
export function getForm(clasName, commentsClassName) {
  return `
    <div>
      <form class="${clasName}">
        <div class="form-group">
          <label>暱稱</label>
          <input name="nickname" class="form-control">
        </div>
        <div class="form-group">
          <label>留言內容</label>
          <textarea name="content" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <div class="${commentsClassName}"></div>
    <div>
  `
}

export function getLoadMoreButton(className) {
  return `<button class="${className} btn btn-danger" type="button">MORE</button>`
}
