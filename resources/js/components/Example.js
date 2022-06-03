import ReactDOM from 'react-dom';

import React, { useState } from "react";

const Example = () => {
  const [text, setText] = useState("");


  return (
    <div className="App">

    <input
        value={text}
        onChange={(event) => setText(event.target.value)}
    />
    <input
        value={text}
        onChange={(event) => (event.target.value)}
    />
        <p>{text}</p>
        <p>{text}</p>
    </div>
  );
};

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
