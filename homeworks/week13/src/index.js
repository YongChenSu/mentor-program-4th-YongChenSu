/* eslint-disable */
import { getComments, addComment} from './api'
import { cssTemplate, getLoadMoreButton, getForm } from './templates'
import { appendComentToDom, appendStyle } from './utils'
import $ from 'jquery'

export function init(options) {
  let siteKey = ''
  let apiUrl = ''
  let containerElement = null
  let lastId = null
  let isEnd = false
  let commentDOM = null
  let loadMoreClassName
  let commentsClassName
  let commentsSelector
  let formClassName
  let formSelector

  siteKey = options.siteKey
  apiUrl = options.apiUrl

  loadMoreClassName = `${siteKey}-load-more`
  commentsClassName = `${siteKey}-comments`
  formClassName = `${siteKey}-add-comment-form`
  commentsSelector = `.${commentsClassName}`
  formSelector = `.${formClassName}`

  containerElement = $(options.containerSelector)
  containerElement.append(getForm(formClassName, commentsClassName))
  appendStyle(cssTemplate)
  
  commentDOM = $(commentsSelector)

  getNewComments()
  commentDOM.on('click', `.${loadMoreClassName}`, () => {
   getNewComments()
  })
  
  $(formSelector).submit(e => {
    e.preventDefault()
    const nicknameDOM = $(`${formSelector} input[name=nickname]`)
    const contentDOM = $(`${formSelector} textarea[name=content]`)
    const newCommentData = {
      site_key: siteKey,
      nickname: nicknameDOM.val(),
      content: contentDOM.val()
    }
    addComment(apiUrl, siteKey, newCommentData, data => {
      if (!data.ok) {
        alert(data.message)
        return
      }
      nicknameDOM.val('')
      contentDOM.val('')
      appendComentToDom(commentDOM, newCommentData, true)
    })
  })

  function getNewComments() {
    $(`.${loadMoreClassName}`).hide()
    if (isEnd) {
      return
    }
    getComments(apiUrl, siteKey, lastId, data => {
      if (!data) {
        alert(data.message)
        return
      }
      const comments = data.discussions
      for (let comment of comments) {
        appendComentToDom(commentDOM, comment)
      }
      let length = comments.length
      if (length === 0) {
        isEnd = true
        $(`.${loadMoreClassName}`).hide()
      } else {
        lastId = comments[length -1].id
        const loadMoreButtonHTML = getLoadMoreButton(loadMoreClassName)
        commentDOM.append(loadMoreButtonHTML)
      }
    })
  }
}

