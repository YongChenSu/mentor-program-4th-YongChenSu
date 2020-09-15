/* eslint-disable */
let limit = 5
let BASE_URL = `./api_comments.php?site_key=yo`

const commentDOM = $('.comments')
function escape(toOutput){
  return toOutput.replace(/\&/g, '&amp;')
    .replace(/\</g, '&lt;')
    .replace(/\>/g, '&gt;')
    .replace(/\"/g, '&quot;')
    .replace(/\'/g, '&#x27')
    .replace(/\//g, '&#x2F')
}

function appendComentToDom(container, comment, isPrepend) {
  const html = `
    <div class="card my-3">
      <div class="card-body">
        <h5 class="card-title">${escape(comment.nickname)}</h5>
        <p class="card-text">${escape(comment.content)}</p>
      </div>
    </div>
  `
  limit += 1
  isPrepend ? container.prepend(html) : container.appedn(html)
}

function getMessage(limit, callback) {
  $.ajax({
    url: `${BASE_URL}&limit=${limit}`,
  }).done(data => {
    if (!data.ok) {
      alert(data.message)
      return
    }
    const boardTemplate = data.discussions.map(comment => `
      <div class="card my-3">
        <div class="card-body">
          <h5 class="card-title">${escape(comment.nickname)}</h5>
          <p class="card-text">${escape(comment.content)}</p>
        </div>
      </div>
    `).join('')
    $(commentDOM).html(boardTemplate)
    callback(data)
  })
}

$(document).ready(() => {
  getMessage(limit, () => {})
  $('.load-more').click(() => {
    limit += 5
    getMessage(limit, data => {
      if (limit > data.discussions.length) {
        limit = data.discussions.length
        $('.load-more').addClass('hide')
      }
    })
  })

  $('.add-comment-form').submit(e => {
    e.preventDefault()
    const newCommentData = {
      site_key: 'yo',
      nickname: $('input[name=nickname]').val(),
      content: $('textarea[name=content]').val()
    }
    $.ajax({
      type: 'POST',
      url: './api_add_comments.php',
      data: newCommentData
    }).done(data => {
      if (!data.ok) {
        alert(data.message)
        return
      }
      nickname = $('input[name=nickname]').val(''),
      content = $('textarea[name=content]').val('')
      appendComentToDom(commentDOM, newCommentData, true)
    })
  })
})
