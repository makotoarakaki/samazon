import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";
 
export default class Ticket extends Component {
    render() {
        return (
            <div>
                <p>タスク</p>
            </div>
        );
    }
}
 
if (document.getElementById('ticket')) {
    ReactDOM.render(<Ticket />, document.getElementById('ticket'));
}