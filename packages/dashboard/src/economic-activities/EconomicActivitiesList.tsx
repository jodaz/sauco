import * as React from "react";
import {
    Filter,
    TextInput,
    List,
    Datagrid,
    NumberField,
    TextField,
    SimpleList,
    TopToolbar,
    ExportButton,
    NumberInput
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const EconomicActivitiesListFilter: React.FC = props => (
    <Filter {...props}>
        <TextInput label="Nombre" source='name' />
        <TextInput label="Código" source='code' />
        <NumberInput label="Alícuota mayor que" source='gt_aliquote' />
        <NumberInput label="Alícuota menor que" source='lt_aliquote' />
        <NumberInput label="Mínimo tributable mayor que" source='gt_min_tax' />
        <NumberInput label="Mínimo tributable menor que" source='lt_min_tax' />
    </Filter>
);

const ListActions = () => (
    <TopToolbar>
        <ExportButton />
    </TopToolbar>
);

const EconomicActivitiesDatagrid = ({ isSmall }: any) => (
    <>
        {
            isSmall
            ? (
                <SimpleList
                    primaryText={record => `${record.name}`}
                    secondaryText={record => `${record.min_tax }`}
                    tertiaryText={record => `${record.aliquote}`}
                    linkType={"show"}
                />
            )
            : (
                <Datagrid>
                    <TextField source="code" label="Código"/>
                    <TextField source="name" label="Nombre"/>
                    <TextField source="aliquote" label="Alícuota"/>
                    <NumberField source='min_tax' label='Mínimo tributable' />
                </Datagrid>
            )
        }
    </>
)

const EconomicActivityList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

    return (
        <List {...props}
            title="Actividades económicas"
            bulkActionButtons={false}
            filters={<EconomicActivitiesListFilter />}
            actions={<ListActions />}
        >
            <EconomicActivitiesDatagrid isSmall={isSmall} />
        </List>
    );
};

export default EconomicActivityList;
