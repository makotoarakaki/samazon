import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'

export default class MailStand extends Component {
  render() {
      return (
          <div>
              <p>タスク</p>
          </div>
      );
  }
}
// bladeファイル内の <div id="mail_stand">に対してこのコンポーネントがレンダリングされる
if (document.getElementById('mail_stand')) {
    ReactDOM.render(<MailStand />, document.getElementById('mail_stand'))
}