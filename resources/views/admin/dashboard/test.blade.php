<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }
    .container {
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        margin-bottom: 20px;
    }
    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
        border-top: 1px solid #ddd;
        text-align: left;
    }
    .notes {
        margin-top: 20px;
        font-style: italic;
    }
    .total {
        font-weight: bold;
        text-align: right;
        margin-top: 10px;
    }
</style>
</head>
<body>

<div class="container">

<h2>Free Scheme Approval Details</h2>

<table>
    <tbody>
        <tr>
            <th>Marketing Executive:</th>
            <td>{{ @$print[0]->FreeScheme->Manager->name }}</td>
        </tr>
        <tr>
            <th>Area Manager:</th>
            <td>{{ @$print[0]->FreeScheme->Manager->AreaManager->name }}</td>
        </tr>
        <tr>
            <th>Zonal Manager:</th>
            <td>{{ @$print[0]->FreeScheme->Manager->ZonalManager->name }}</td>
        </tr>
        <tr>
            <th>Doctor:</th>
            <td>{{ @$print[0]->FreeScheme->Doctor->doctor_name }}</td>
        </tr>
        <tr>
            <th>Speciality:</th>
            <td>{{ @$print[0]->FreeScheme->Doctor->speciality }}</td>
        </tr>
        <tr>
            <th>Location:</th>
            <td>{{ @$print[0]->FreeScheme->location }}</td>
        </tr>
        <tr>
            <th>Proposal Date:</th>
            <td>{{ @$print[0]->FreeScheme->proposal_date }}</td>
        </tr>
        <tr>
            <th>Proposal Month:</th>
            <td>{{ @$print[0]->FreeScheme->proposal_month }}</td>
        </tr>
        <tr>
            <th>Free Scheme Type:</th>
            <td>{{ @$print[0]->FreeScheme->free_scheme_type }}</td>
        </tr>
        <tr>
            <th>Stockist:</th>
            <td>{{ @$print[0]->FreeScheme->Stockist->stockist }}</td>
        </tr>
        <tr>
            <th>Stockist's Contact No:</th>
            <td>{{ @$print[0]->FreeScheme->Stockist->contact_no }}</td>
        </tr>
        <tr>
            <th>Chemist:</th>
            <td>{{ @$print[0]->FreeScheme->Chemist->chemist }}</td>
        </tr>
        <tr>
            <th>Chemist's Contact No:</th>
            <td>{{ @$print[0]->FreeScheme->Chemist->contact_no_1 }}</td>
        </tr>
        <tr>
            <th>Open Scheme:</th>
            <td>{{ @$print[0]->FreeScheme->open_scheme }}</td>
        </tr>
        <tr>
            <th>Scheme (%):</th>
            <td>{{ @$print[0]->FreeScheme->scheme }}%</td>
        </tr>
        <tr>
            <th>CRM Done:</th>
            <td>{{ @$print[0]->FreeScheme->crm_done }}</td>
        </tr>
        <tr>
            <th>Dr Own Counter:</th>
            <td>{{ @$print[0]->FreeScheme->dr_own_counter }}</td>
        </tr>
        <tr>
            <th>Remark:</th>
            <td>{{ @$print[0]->FreeScheme->remark }}</td>
        </tr>
    </tbody>
</table>


<table>
    <thead>
        <tr>
            <th>Products:</th>
            <th>NRV:</th>
            <th>Quantity:</th>
            <th>Free Quantity:</th>
            <th>Free %:</th>
            <th>Amount:</th>
        </tr>
        <tbody>
            @if(!empty($print))
            @foreach($print as $detail)    
            <tr>
                <td>{{ @$detail->Product->name }}</td>      
                <td>{{ @$detail->nrv }}</td>      
                <td>{{ @$detail->qty }}</td>   
                <td>{{ @$detail->free_qty }}</td>   
                <td>{{ @$detail->free }}%</td>    
                <td>₹{{ @$detail->val }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </thead>
</table>     

<p class="total">Total Amount: ₹{{ @$print[0]->FreeScheme->amount }}</p>

</div>

</body>
</html>
