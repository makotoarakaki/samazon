import React from 'react';
import ReactDOM from 'react-dom';

import NavBar from './NavBar'
import About from './About'
import User from './User'

function App() {
    return (
    <div>
        <NavBar />
        <About />
        <User />
    </div>
    )
}

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}