import { withThemeCreator } from "@material-ui/styles";
import axios from "axios";
import React, {Component} from "react";
import ReactDOM from 'react-dom';

export default class ChatApp extends Component {
  constructor(props){
    super(props);
    // this.getAddressData = this.getAddressData.bind(this);

    this.state = {
      status : '更新中',
      msg :'',
    };
  }

  render(){
    return (
        <div className="container">
          <h1>ChatAPP</h1>
        </div>
    )
  }

}

if (document.getElementById('ChatApp')) {
  ReactDOM.render(<ChatApp/>,document.getElementById('ChatApp'));
}
