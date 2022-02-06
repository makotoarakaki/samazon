import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route } from 'react-router-dom';

const Index = () => {
    <BrowserRouter>
        <Route exact path="/users" component={UsersList} />
	<Route exact path="/users/:id" component={UsersShow} />
	<Route exact path="/users/create" component={UsersCreate} />
	<Route exact path="/users/:id/edit" component={UsersEdit} />
    </BrowserRouter>
}

if (document.getElementById('index')) {
  ReactDOM.render(<Index />, document.getElementById('index'));
}