<table id="batchTable" class="tablesorter">
  <thead>
  <tr>
    <th>id</th>
    <th>job</th>
    <th>frame</th>
    <th>slice</th>
    <th>count</th>
    <th>issued</th>
    <th>duration [sec]</th>
    <th>client</th>
    <th>cid</th>
  </tr>
  </thead>
  <tbody>
{section name=id loop=$results}
  <tr>
    <td align="right">{$results[id]->id}</td>
    <td align="right">{$results[id]->job}</td>
    <td align="right">{$results[id]->frame}</td>
    <td align="right">{$results[id]->slice}</td>
    <td align="right">{$results[id]->count}</td>
    <td align="right">{$results[id]->issued}</td>
    <td align="right">{$results[id]->time}</td>
    <td align="right">{$results[id]->client}</td>
    <td align="right">{$results[id]->cid}</td>
  </tr>
{sectionelse}
  <tr>
    <td colspan=9>no matching batches found.</td>
  </tr>
{/section}
  </tbody>
</table>
