<button>Add Details</button>
<table style="max-width:50px;">
	<caption>HVC ONE TIME CHILD PROTECTION FUND REQUEST FORM</caption>
	<thead>
		<tr>
			<th>Project No</th>
			<th colspan="2"><INPUT type="text" name="icpNo" id="icpNo"/></th>
			<th>Date</th>
			<th colspan="2"><INPUT type="text" name="claimDate" id="claimDate"/></th>
		</tr>
		<tr>
			<th>Child Number</th>
			<th colspan="2"><INPUT type="text" name="childNo" id="childNo"/></th>
			<th>Child Name</th>
			<th colspan="2"><INPUT type="text" name="childName" id="childName"/></th>
		</tr>
		<tr>
			<th colspan="3">Name of the Person Filling in the Form</th>
			<th colspan="3"><INPUT type="text" name="userID" id="userID"/></th>
		</tr>
		<tr>
			<th>Name of PF</th>
			<th colspan="2"><INPUT type="text" name="pfName" id="pfName"/></th>
			<th>Cluster</th>
			<th colspan="2"><INPUT type="text" name="cluster" id="cluster"/></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="6">
				DESCRIPTION OF NEED AND CURRENT STATUS OF THE CHILD AND FAMILY
			</td>
		</tr>
		<tr>
			<td colspan="6">
				<textarea cols="90" rows="5" name="desc"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="3">TYPE OF INTERVENTION:</td><td colspan="3"><INPUT type="text" name="intervention" id="intervention"/></td>
		</tr>
		<tr>
			<td colspan="6">LIST OF ITEMS REQUESTED</td>
		</tr>
		<tr>
			<td colspan="2">Item</td>
			<td>Number/ Quantity</td>
			<td>Cost Per Unit</td>
			<td>Total Cost</td>
			<td>Remarks</td>
		</tr>
		<tr>
			<td colspan="2"><INPUT type="text" name="item[]" id=""/></td>
			<td><INPUT type="text" name="qty[]" id=""/></td>
			<td><INPUT type="text" name="unitcost[]" id=""/></td>
			<td><INPUT type="text" name="totalcost[]" id=""/></td>
			<td><INPUT type="text" name="remarks[]" id=""/></td>
		</tr>
		<tr>
			<td colspan="4">Totals</td>
			<td colspan="2"><INPUT type="text" name="totals" id=""/></td>
		</tr>		
	</tbody>
</table>