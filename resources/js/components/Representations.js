import React, { Fragment, useState, useEffect } from 'react';
import axios from 'axios';
// Components
import Loading from './Loading';
import WidgetItem from './WidgetItem';
import WidgetIcon from './WidgetIcon';
import WidgetInfo from './WidgetInfo';

const renderChildComponent = (loading, data) => {
  return (!loading) ?
    (data.length > 0) ?
      data.map((rep, index) => (
        <WidgetItem key={index}>
          <WidgetIcon 
            type='image'
            icon='/assets/images/user-default.png'
          />
          <WidgetInfo
            title={rep.person.name}
            desc={rep.representation_type.name}
          />
        </WidgetItem>
      ))
    :
      <WidgetItem>
        <WidgetIcon
          type="icon"
          icon="fas fa-question-circle"
        />
        <WidgetInfo
          desc='No tiene representante legal asignado'
        />
      </WidgetItem>
    :
    <Loading />
}

const Representations = props => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);
  
  useEffect(() => {
    axios.get(`/api/taxpayers/${props.taxpayerId}/representations`)
      .then((res) => setData( res.data ))
      .then((res) => setLoading(false))
      .catch((err) => console.log(err));
  }, [props]);

  let renderer = renderChildComponent(loading, data);

  return (
    <Fragment>
     {renderer}
    </Fragment>
  );
}

export default Representations;
