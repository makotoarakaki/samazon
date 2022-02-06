import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";
 
export default class Ticket extends Component {
    constructor() {
        super();
        this.state = {
            tickets: []
        };
    }
    componentDidMount() {
        axios
            .get('/api/tickets')
            .then(response => {
                this.setState({
                    tickets: response.data
                });
 
            }).catch(error => {
                console.log(error);
            });
    }
    render() {
        const list = this.state.tickets.map((item) => {
            return <li key={item.id}>{item.title}</li>;
        });
        return (
            <div>
                <ul className="ticket-list">
                    {list}
                    テスト
                </ul>
            </div>
        );
    }
}
 
if (document.getElementById('ticket')) {
    ReactDOM.render(<Ticket />, document.getElementById('ticket'));
}